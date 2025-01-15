<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <h1>Posts</h1>
        <form @submit.prevent="createPost" enctype="multipart/form-data">
            <input type="text" v-model="newPost.title" placeholder="Title" required>
            <textarea v-model="newPost.content" placeholder="Content" required></textarea>
            <input type="file" ref="image" accept="image/*">
            <button type="submit">Create Post</button>
        </form>
        <ul>
            <li v-for="post in posts" :key="post.id">
                <h3>@{{ post.title }}</h3>
                <p>@{{ post.content }}</p>
                <img v-if="post.image" :src="`/storage/${post.image}`" alt="Post Image" style="max-width: 200px;">
            </li>
        </ul>
    </div>
    <script>
    const app = Vue.createApp({
        data() {
            return {
                posts: [],
                newPost: {
                    title: '',
                    content: ''
                }
            };
        },
        methods: {
            fetchPosts() {
                axios.get('/posts/data') // Исправленный маршрут
                    .then(response => {
                        this.posts = response.data; // Загружаем существующие посты
                    })
                    .catch(error => {
                        console.error('Error fetching posts:', error);
                    });
            },
            createPost() {
                const formData = new FormData();
                formData.append('title', this.newPost.title);
                formData.append('content', this.newPost.content);
                if (this.$refs.image.files[0]) {
                    formData.append('image', this.$refs.image.files[0]);
                }

                axios.post('/posts/store', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                .then(response => {
                    this.posts.push(response.data); // Добавляем новый пост в список
                    this.newPost.title = '';
                    this.newPost.content = '';
                    this.$refs.image.value = '';
                })
                .catch(error => {
                    console.error('Error creating post:', error);
                });
            }
        },
        mounted() {
            this.fetchPosts(); // Загружаем посты при загрузке страницы
        }
    });

    app.mount('#app');
</script>
</body>

</html>
