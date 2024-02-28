<script setup>
</script>

<template>
    <div class="black-layout">
     <div class="__layout">
        <header>
            <slot name="header">
            </slot>
        </header>
        <main>
            <slot name="main">
            </slot>
        </main>
        <footer>
            <slot name="footer">
            </slot>
        </footer>
        </div>
    </div>
</template>
