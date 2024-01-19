<script setup>

const props = defineProps(
    {
        name:String,
        src:String,
        logoName:String,
        class:String,
    }
)
console.log(props)

</script>

<template>
    <div :class="class">
        <router-link  :to="{name:name}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img class="w-[40px]" :src="src" :alt="name" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{logoName}}</span>
    </router-link >
    </div>
</template>
<style scoped>
</style>