<template>
  <article @click="show" class="pointer mb-3">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4>
            <slot name="title"></slot>
          </h4>
        </div>
        <section>
            <slot></slot>
        </section>
        <small class="float-right">
            <slot name="published"></slot>
        </small>
      </div>
    </div>
  </article>
</template>


<script>
export default {
    props: {
        slug: String
    },
    methods: {
        show() {
            window.location.href = "/posts/" + this.slug
        }
    }

};
</script>


<style scoped>
   .pointer {
       cursor: pointer;
   }
</style>