<script>
export default {
    props: {
        articles: Object,
    },
    data() {
        return {
            loadingMore: false,
            loadingMoreVisible: true,
            localArticles: this.articles.data,
            pagination: this.articles,
        };
    },
    methods: {
        loadMore() {
            if (this.loadingMore) {
                return;
            }

            if (this.pagination.next_page_url === null) {
                this.loadingMoreVisible = false;
            }

            axios.get(`${this.pagination.next_page_url}`)
                .then(({data}) => {
                    this.localArticles = [
                        ...this.localArticles,
                        ...data.data,
                    ];

                    this.pagination = data;
                    if (data.data.length === 0) {
                        this.loadingMoreVisible = false;
                    }
                })
                .finally(() => this.loadingMore = false);
        }
    },
}
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="max-w-2xl mx-auto mb-15 text-center">
                <h1 class="font-heading text-5xl xs:text-6xl md:text-7xl font-bold">
                    <span class="font-serif">Articles</span>
                </h1>
            </div>
            <div class="max-w-5xl mx-auto">
                <div class="py-12 border-t-2 border-gray-100" v-for="article in localArticles" :key="article.id">
                    <div class="flex flex-wrap lg:flex-nowrap items-center">
                        <div class="w-full lg:w-auto px-4 mb-8 lg:mb-0">
                            <img class="block w-44 h-30" src="saturn-assets/images/blog/image-blog-small-2.png" alt="">
                        </div>
                        <div class="w-full lg:w-9/12 px-4 mb-10 lg:mb-0">
                            <div class="max-w-2xl">
                                <span class="block text-gray-400 mb-1"> {{ new Date(article.created_at).toLocaleString() }} </span>
                                <span class="block text-gray-400 mb-1"> Category: {{ article.category.name }} </span>
                                <p class="text-2xl font-semibold text-gray-900">{{ article.title }}</p>
                                <p class="text-2xl font-semibold text-gray-500">{{ article.content }}</p>
                            </div>
                        </div>
                        <div class="w-full lg:w-auto px-4 ml-auto text-right">
                            <a class="inline-flex items-center text-xl font-semibold text-orange-900 hover:text-gray-900" :href="route('articles.show', article.id)">
                                <span class="mr-2">Read</span>
                                <svg class="animate-bounce" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.33301 14.6668L14.6663 1.3335" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1.33301 1.3335H14.6663V14.6668" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pt-12 border-t-2 border-gray-100 text-center">
                    <div class="relative group inline-block py-4 px-7 font-semibold text-orange-900 hover:text-orange-50 rounded-full bg-orange-50 transition duration-300 overflow-hidden" href="#" style="cursor: pointer" @click="loadMore" :disabled="loadingMore" v-if="loadingMoreVisible">
                        <div class="absolute top-0 right-full w-full h-full bg-gray-900 transform group-hover:translate-x-full group-hover:scale-102 transition duration-500"></div>
                        <span class="relative">See More Articles</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
