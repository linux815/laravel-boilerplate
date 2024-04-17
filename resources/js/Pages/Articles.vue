<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Article from "@/Pages/Article/Article.vue";
defineProps(['articles']);
</script>

<template>
    <AppLayout title="Articles">
        <div class="relative container px-4 mx-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Article :articles="articles"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
