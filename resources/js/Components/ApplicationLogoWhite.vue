<script setup>
// Pas de logique spécifique nécessaire pour ce composant SVG
</script>

<template>
    <svg data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 106.5 90.44">
        <g data-name="Calque 1">
            <path class="path-style" d="m56.55 53.48 33.44 33.43-3.53 3.53-33.44-33.43L20.14 89.9l-3.54-3.54 32.89-32.89-33.32-33.31 3.53-3.54 33.31 33.32 33.88-33.87 3.53 3.54-33.87 33.87z"/>
            <circle class="circle-red" cx="53.08" cy="15.68" r="13.18"/>
            <circle class="circle-yellow" cx="15.68" cy="53.54" r="13.18"/>
            <circle class="circle-purple" cx="90.82" cy="53.42" r="13.18"/>
        </g>
    </svg>
</template>

<style scoped>
.path-style {
    stroke-width: 0;
}

.circle-red {
    fill: #ff1d25;
    stroke: #000;
    stroke-miterlimit: 10;
    stroke-width: 5px;
}

.circle-yellow {
    fill: #ff0;
    stroke: #020202;
    stroke-miterlimit: 10;
    stroke-width: 5px;
}

.circle-purple {
    fill: #f0f;
    stroke: #020202;
    stroke-miterlimit: 10;
    stroke-width: 5px;
}
</style>