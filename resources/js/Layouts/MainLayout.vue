<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <nav class="">
        <!-- Primary Navigation Menu -->
        <div class="">
            <div class="">
                <div class="">
                    <!-- Logo -->
                    <!-- <div class="">
                        <Link :href="route('dashboard')">
                        <ApplicationLogo class="logo" />
                        </Link>
                    </div> -->

                    <!-- Navigation Links -->
                    <!-- <div class="">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink>
                    </div> -->
                </div>

                <div class="">
                    <!-- Settings Dropdown -->
                    <!-- <div class="">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="">
                                    <button type="button" class="">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div> -->
                </div>

                <!-- Hamburger -->
                <!-- <div class="">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="">
                        <svg class="" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex': !showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex': showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="">
            <!-- <div class="">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </ResponsiveNavLink>
            </div> -->

            <!-- Responsive Settings Options -->
            <div class="">
                <div class="">
                    <div class="">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="">{{ $page.props.auth.user.email }}</div>
                </div>

                <div class="">
                    <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </ResponsiveNavLink>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    <header class="" v-if="$slots.header">
        <div class="">
            <slot name="header" />
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <slot />
    </main>
</template>
