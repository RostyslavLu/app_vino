<script setup>
import { ref, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cellar: Object
});

let showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};
</script>

<template>
    <div>
        <img v-if="!showMenu" src="/img/icons/menu.svg" alt="menu" class="icon hamburger-icon" @click="toggleMenu"/>
        <svg v-else xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="var(--primary)" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-x-menu" @click="toggleMenu">
            <line x1="18" y1="6" x2="6" y2="18" stroke="var(--primary)" fill="var(--primary)"></line>
            <line x1="6" y1="6" x2="18" y2="18"  stroke="var(--primary)" fill="var(--primary)"></line>
        </svg>      
          
        <div v-if="showMenu" class="mobile-menu">
            <section>
                <h2>Cellier</h2>
                <div class="flex-row">
                    <svg class="icon" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333.23 333.23">
                        <g id="Calque_1-2" data-name="Calque 1">
                            <path class="__white" d="m173.19 180.84 72.58 72.58-7.07 7.07-72.58-72.58-71.41 71.4-7.07-7.07 71.41-71.4-72.35-72.35 7.07-7.07 72.35 72.35 73.52-73.53 7.07 7.07-73.52 73.53z"/>
                            <circle class="__white" cx="166.24" cy="101.25" r="28.5"/>
                            <circle class="__white" cx="87.53" cy="180.96" r="28.5"/>
                            <circle class="__white" cx="245.71" cy="180.71" r="28.5"/>
                            <circle cx="166.62" cy="166.62" r="161.62" style="fill:none;stroke:var(--secondary);stroke-miterlimit:10;stroke-width:10px"/>
                        </g>
                    </svg>    
                    <Link 
                        href="/dashboard"
                        :class="{ '__active': $page.url === '/dashboard'}"
                        >{{ cellar.name }}</Link
                    >
                </div>
            </section>
                <div class="flex-row">
                <img src="/img/icons/user-white.svg" alt="menu" class="icon"/>
                <Link 
                    href="/profile"
                    :class="{ '__active': $page.url === '/profile'}" 
                    >Profil</Link
                >
            </div>
            <div class="flex-row">
                <img src="/img/icons/log-out-white.svg" alt="menu" class="icon"/>
                <Link 
                    href="/logout"
                    class="__logout" 
                    method="post" 
                    as="button" 
                    type="button"
                    >Logout</Link
                >
            </div>
        </div>
        <div class="desktop-menu">
            <div class="flex-column">
                    <svg class="icon" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333.23 333.23">
                        <g id="Calque_1-2" data-name="Calque 1">
                            <path class="__black" d="m173.19 180.84 72.58 72.58-7.07 7.07-72.58-72.58-71.41 71.4-7.07-7.07 71.41-71.4-72.35-72.35 7.07-7.07 72.35 72.35 73.52-73.53 7.07 7.07-73.52 73.53z"/>
                            <circle class="__black" cx="166.24" cy="101.25" r="28.5"/>
                            <circle class="__black" cx="87.53" cy="180.96" r="28.5"/>
                            <circle class="__black" cx="245.71" cy="180.71" r="28.5"/>
                            <circle cx="166.62" cy="166.62" r="161.62" style="fill:none;stroke:var(--primary);stroke-miterlimit:10;stroke-width:10px"/>
                        </g>
                    </svg>                
                <Link 
                    href="/dashboard"
                    :class="{ '__active': $page.url === '/dashboard'}"
                    >Cellier</Link
                >
            </div>
            <div class="flex-column"> 
                <img src="/img/icons/user-black.svg" alt="menu" class="icon"/>  
                <Link 
                    href="/profile"
                    :class="{ '__active': $page.url === '/profile'}"
                    >Profil</Link>
            </div>
            
            <div class="flex-column">
                <img src="/img/icons/log-out-black.svg" alt="menu" class="icon"/>
                <Link 
                    href="/logout"
                    class="__logout" 
                    method="post" 
                    as="button" 
                    type="button"
                    >Logout</Link
                >
            </div>
        </div>
    </div>
</template>
