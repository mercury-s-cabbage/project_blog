<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poosts</title>
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

                <button @click="editPost(post)">Edit</button>
                <button @click="deletePost(post.id)">Delete</button>

                <!-- Редактор под постом -->
                <div v-if="editingPost && editingPost.id === post.id">
                    <h2>Edit Post</h2>
                    <form @submit.prevent="updatePost">
                        <input type="text" v-model="editingPost.title" placeholder="Title" required>
                        <textarea v-model="editingPost.content" placeholder="Content" required></textarea>
                        <button type="submit">Update Post</button>
                        <button @click="cancelEdit">Cancel</button>
                    </form>
                </div>
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
                },
                editingPost: null // Пост для редактирования
            };
        },
        methods: {
            fetchPosts() {
            axios.get('/posts/data') // Здесь маршрут уже верный
                .then(response => {
                    this.posts = response.data;
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

            axios.post('/posts', formData, { // POST-запрос на /posts
                headers: { 'Content-Type': 'multipart/form-data' }
            })
            .then(response => {
                this.posts.push(response.data);
                this.newPost.title = '';
                this.newPost.content = '';
                this.$refs.image.value = '';
            })
            .catch(error => {
                console.error('Error creating post:', error);
            });
        }
,
            deletePost(id) {
                if (confirm('Are you sure you want to delete this post?')) {
                    axios.delete(`/posts/${id}`)
                        .then(() => {
                            this.fetchPosts(); // Перезагрузить список постов
                        })
                        .catch(error => {
                            console.error('Error deleting post:', error);
                        });
                }
            },
            editPost(post) {
                this.editingPost = { ...post }; // Копируем данные поста
            },
            updatePost() {
                axios.put(`/posts/${this.editingPost.id}`, this.editingPost)
                    .then(response => {
                        this.fetchPosts(); // Перезагрузить список
                        this.editingPost = null; // Сбросить редактируемый пост
                    })
                    .catch(error => {
                        console.error('Error updating post:', error);
                    });
            }
        },
        mounted() {
            this.fetchPosts();
        }
    });

    app.mount('#app');
</script>


</body>

</html>
