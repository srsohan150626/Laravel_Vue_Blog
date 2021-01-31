<template>
    <div>
        <h1>The Number is : {{ views }}</h1>
    <button @click="updateCounter(1)"> Increase</button>
    <button @click="updateCounter(-1)"> Decrease</button>
    <br>
    <br>
    <div v-for="(blog,i) in blogs" :key="i" v-if="blogs.length">
        <h1>{{ blog.title }}</h1>
         <p>{{ blog.post }}</p>

    </div>
    
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            views: 0,
            blogs: [],
        }
    },
    methods: {
        updateCounter(number){
            this.views += number
        }
    },

    created(){
        this.views = 100
        let posts = [
                {title: 'this is blog title 1', post: 'this is a blog post 1', id: 1},
                {title: 'this is blog title 2', post: 'this is a blog post 2', id: 2},
                {title: 'this is blog title 3', post: 'this is a blog post 3', id: 3},
                {title: 'this is blog title 4', post: 'this is a blog post 4', id: 4}
            ]
        this.blogs= posts
    }
}
</script>