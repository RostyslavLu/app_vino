<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const { wines } = usePage().props.wines;
</script>


<template>
  <div>
    <h1>Les vins</h1>
    <ul>

      <li v-for="wine in $wines" :key="wine.id">
        {{ wine.name }}
      </li>
    </ul>
    
    <!-- Pagination -->
<!--     <div>
      <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">Previous</Link>
      <Link v-if="wines.next_page_url" :href="wines.next_page_url">Next</Link>
    </div> -->
  </div>
</template>
