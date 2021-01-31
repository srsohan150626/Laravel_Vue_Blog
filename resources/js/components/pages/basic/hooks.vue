<template>
    <div>
        <h2>vue hooks</h2>
        <p>My name is: {{ name }}</p>
    </div>
</template>

<script>
export default {
    data(){
        return {
            name: 'sohan'
        }
    }, 

    created(){
        console.log('data and other function is available but not html', this.name)
        
    }
}
</script>