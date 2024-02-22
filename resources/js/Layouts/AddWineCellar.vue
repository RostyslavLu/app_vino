<script setup>
</script>

<template>
    <div>
        <header>
            <slot name="header">
                <h2>Ajouter un vin à mon cellier</h2>
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
</template>
