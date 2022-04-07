<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(error, key) in getErrorMessage" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        computed: {
            errors() {
                //console.log(this.$page);
                return this.$page.props.errors
            },

            flash(){
                return this.$page.props.flash;
            },

            getErrorMessage() {
                if(this.flash.message){
                  return this.$page.props.flash;
                } else if(Object.keys(this.errors).length > 0){
                  return this.$page.props.errors;
                }
              return this.$page.props.errors
            },

            hasErrors() {
                if(Object.keys(this.errors).length > 0){
                  return true;
                } else if(this.flash.messages === null){
                  return true;
                }
                return false;
            },
        }
    })
</script>
