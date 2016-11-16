<template>
    <div :class="errorClass"><ul class="mb0"></ul></div>
</template>

<script>
    export default{
        props: {
            prefix: {
                type: String,
                required: true
            },
            subClass: {
                type: String,
                default: ''
            }
        },

        computed: {
            errorClass(){
                var self = this;

                return ['errlist', self.prefix + '-error-msg', self.subClass];
            }
        }
    }
</script>