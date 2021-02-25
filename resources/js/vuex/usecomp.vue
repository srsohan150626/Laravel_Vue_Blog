<template>
    <div>
        <div class="content">
			<div class="container-fluid">
                     <h1>I will show how other components work!</h1>
                     <h2>Current state of Counter is: {{ getCounter }}</h2>
                     <div>
                         <comA></comA>
                     </div>
                     <div>
                         <comB></comB>
                     </div>
                     <div>
                         <comC></comC>
                     </div>
                     <Button type="info" @click="changeCounter"> Change the State of Counter</Button>
            </div>
        </div>
    </div>
</template>

<script>
import comA from './comA'
import comB from './comB'
import comC from './comC'
import {mapGetters} from 'vuex'

export default {
    computed : {
        ...mapGetters(['getCounter'])
    },
    methods: {
        changeCounter(){
            this.$store.commit('changeTheCounter',1)
        }
    },
    components: {
        comA,
        comB,
        comC
    }
}
</script>