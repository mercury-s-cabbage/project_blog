<template>
    <div>
        <h1>Blog Posts</h1>
        <div v-for="post in posts" :key="post.id">
            <h2>{{ post.title }}</h2>
            <p>{{ post.content }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        axios.get('/api/posts').then(response => {
            this.posts = response.data;
        });
    },
};
</script>
