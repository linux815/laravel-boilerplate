<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CommentIndex from "@/Pages/Comment/Index.vue";
const props = defineProps(['article']);
</script>

<template>
    <AppLayout title="Show article">
        <div class="relative container px-4 mx-auto mt-2 mb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a class="inline-flex items-center text-xl font-semibold text-orange-900 hover:text-gray-900" :href="route('articles')">
                        &nbsp; <svg class="animate-pulse" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#000" d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
	L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
	c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
	c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
	S18.707,9.212,18.271,9.212z"></path>
                    </svg>
                        &nbsp;
                        <span class="mr-2">Back</span>
                    </a>
                    <hr/>
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <span class="block text-gray-400 mb-1"> Category: {{ article.category.name }} </span>
                        <h1 class="mt-2 text-2xl font-medium text-gray-900">
                            {{ article.title }}
                        </h1>

                        <div class="mt-6 text-gray-500 leading-relaxed">
                            <p v-html="article.content" />
                        </div>
                    </div>

                    <CommentIndex :article-id="article.id" :article="article"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
