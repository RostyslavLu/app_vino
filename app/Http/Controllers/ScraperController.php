<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saq_wine;
use Goutte\Client;

class ScraperController extends Controller
{
    /**
     * pour scraper les informations de la SAQ
     * premièrement il faut installer Goutte avec la commande suivante:
     * composer require fabpot/goutte
     * @return array
     */

    public function scraper()
    {
        $wines = [
            'rouge',
            'blanc',
            'rose'
        ];
        $report = [];
        foreach ($wines as $wine) {
            $client = new Client();
            $crawler = $client->request('GET', 'https://www.saq.com/fr/produits/vin/vin-' . $wine . '?p=1&product_list_order=name_asc&product_list_limit=24');
            $pagesNumber = 1;
            // récupère le nombre de pages pour chaque catégorie de vin
            $crawler->filter('span.toolbar-number')->each(function ($node) use (&$pagesNumber) {
                $pages = $node->text();
                $pagesNumber = ceil($pages / 24);
            });

            // scrap la page de la SAQ pour obtenir les codes SAQ
            for ($i = 1; $i <= $pagesNumber; $i++) {

                $crawler = $client->request('GET', 'https://www.saq.com/fr/produits/vin/vin-' . $wine . '?p=' . $i . '&product_list_order=name_asc&product_list_limit=24');
                $items = $crawler->filter('div.saq-code')->each(function ($node) {
                    $codeSaq = $node->filter('span')->eq(1)->text();
                    return $codeSaq;
                });
                $products = [];
                set_time_limit(300);
                // scrap chaque page de vin pour obtenir les informations
                foreach ($items as $item) {
                    // vérifie si le produit existe déjà dans la base de données
                    $existingProduct = Saq_wine::where('code_wine', $item)->first();
                    if ($existingProduct) {
                        continue;
                    } else {
                        $crawler = $client->request('GET', 'https://www.saq.com/fr/' . $item);
                        try {
                            $title = $crawler->filter('div.page-title-wrapper > h1.page-title')->text();
                            $codeSaq = $item;
                            try {
                                $imageContent = $crawler->filter('a.MagicZoom')->attr('href');
                                $image_url_arr = explode('?', $imageContent);
                                $image = $image_url_arr[0];
                            } catch (\Exception $e) {
                                // si l'image n'est pas trouvée, utilise une image par défaut
                                $image = 'https://www.saq.com/media/wysiwyg/placeholder/category/06.png';
                            }
                            try {
                                $info_details = $crawler->filter('div.wrapper-content-info')->text();
                            } catch (\Exception $e) {
                                // si les détails ne sont pas trouvés, utilise une description par défaut
                                $info_details = 'Aucune description disponible';
                            }
                            try {
                                $priceContent = $crawler->filter('span.price')->text();
                                $priceArr = explode(' ', $priceContent);
                                $price = $priceArr[0];
                            } catch (\Exception $e) {
                                // si le prix n'est pas trouvé, utilise un prix par défaut
                                $price = 'Aucun prix disponible';
                            }
                            try {
                                $format = $crawler->filter('ul.list-attributs strong[data-th="Format"]')->text();
                            } catch (\Exception $e) {
                                // si le format n'est pas trouvé, utilise un format par défaut
                                $format = 'format non disponible';
                            }
                            try {
                                $regulated_designation = $crawler->filter('ul.list-attributs strong[data-th="Désignation réglementée"]')->text();
                            } catch (\Exception $e) {
                                // si la désignation réglementée n'est pas trouvée, utilise une désignation réglementée par défaut
                                $regulated_designation = 'désignation réglementée non disponible';
                            }
                            $country = $crawler->filter('ul.list-attributs strong[data-th="Pays"]')->text();
                            try {
                                $region = $crawler->filter('ul.list-attributs strong[data-th="Région"]')->text();
                            } catch (\Exception $e) {
                                // si la région n'est pas trouvée, utilise une région par défaut
                                $region = 'région non disponible';
                            }
                            try {
                                $grape_varieties = $crawler->filter('ul.list-attributs strong[data-th="Cépage"]')->text();
                            } catch (\Exception $e) {
                                // si les cépages ne sont pas trouvés, utilise des cépages par défaut
                                $grape_varieties = 'cépages non disponibles';
                            }
                            try {
                                $degree_alcohol = $crawler->filter('ul.list-attributs strong[data-th="Degré d\'alcool"]')->text();
                            } catch (\Exception $e) {
                                // si le degré d'alcool n'est pas trouvé, utilise un degré d'alcool par défaut
                                $degree_alcohol = 'degré d\'alcool non disponible';
                            }
                            try {
                                $sugar_content = $crawler->filter('ul.list-attributs strong[data-th="Taux de sucre"]')->text();
                            } catch (\Exception $e) {
                                // si la teneur en sucre n'est pas trouvée, utilise une teneur en sucre par défaut
                                $sugar_content = 'teneur en sucre non disponible';
                            }
                            if ($wine == 'rouge') {
                                $type_id = 1;
                            } elseif ($wine == 'blanc') {
                                $type_id = 2;
                            } elseif ($wine == 'rose') {
                                $type_id = 3;
                            }
                        } catch (\Exception $e) {
                            //continue;
                            return 'Error: ' . $e->getMessage();
                        }
                        // enregistre les informations dans un tableau
                        $product = [
                            'name' => $title,
                            'code_wine' => $codeSaq,
                            'url' => 'https://www.saq.com/fr/' . $item,
                            'url_image' => $image,
                            'description' => $info_details,
                            'price' => $price,
                            'format' => $format,
                            'regulated_designation' => $regulated_designation,
                            'country' => $country,
                            'region' => $region,
                            'grape_varieties' => $grape_varieties,
                            'degree_alcohol' => $degree_alcohol,
                            'sugar_content' => $sugar_content,
                            'type_id' => $type_id
                        ];
                        $products[] = $product;
                        $reportElement = 'Scraped ' . $title;
                        $report[] = $reportElement;

                    }
                }
                // enregistre les informations dans la base de données
                foreach ($products as $productData) {
                    $product = new Saq_wine();
                    $product->name = $productData['name'];
                    $product->code_wine = $productData['code_wine'];
                    $product->url = $productData['url'];
                    $product->url_image = $productData['url_image'];
                    $product->description = $productData['description'];
                    $price = str_replace(['$'], '', $productData['price']);
                    $price = str_replace([','], '.', $price);
                    $price = trim($price);
                    $product->price = floatval($price);
                    $product->format = $productData['format'];
                    $product->regulated_designation = $productData['regulated_designation'];
                    $product->country = $productData['country'];
                    $product->region = $productData['region'];
                    $product->grape_varieties = $productData['grape_varieties'];
                    $product->degree_alcohol = $productData['degree_alcohol'];
                    $product->sugar_content = $productData['sugar_content'];
                    $product->types_id = $productData['type_id'];
                    $product->save();
                }
            }
        }
        $countEl= count($report);
        // retourne les informations (pour le test seulement)
        return 'Scraped ' . $countEl . ' wines';
    }
}
