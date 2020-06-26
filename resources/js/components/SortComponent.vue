<template>
    <div class="float-right">
        <button @click="load" class="btn btn-primary"><i :class="icon"></i></button>
    </div>
</template>

<script>
export default {
    props: {
        order: String
    },
    computed: {
        icon(){
            if(this.order == "desc") {
                return  "fas fa-sort-amount-down-alt"
            }

            return "fas fa-sort-amount-up-alt"
        }
    },
    methods: {
        load() {
            let order = "asc"
            
            if(this.order == order) {
                order = "desc"
            }

            window.location.href = "/?order=" + order
        }
    }
}
</script>