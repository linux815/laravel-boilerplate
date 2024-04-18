<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

const props = defineProps({articleId: Number, errors: Object, article: Object});
dayjs.extend(relativeTime);

const form = useForm({
    comment: '',
    article_id: props.articleId,
});
</script>

<template>
    <div class="max-w-2xl mx-left p-4 sm:p-6 lg:p-8">
        <form @submit.prevent="form.post(route('comments.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.comment"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
            <InputError :message=" $page.props.errors.comment" class="mt-2"/>
            <PrimaryButton class="mt-4">Comment</PrimaryButton>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2" v-for="comment in article.comments">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ comment.user.name }}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ dayjs(comment.created_at).fromNow() }}</small>
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ comment.comment }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
