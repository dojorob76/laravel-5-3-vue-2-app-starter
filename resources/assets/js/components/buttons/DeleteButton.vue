<template>
    <button class="btn btn-danger" @click.prevent="deleteItem">
        <i class="fa fa-times-circle"></i>&nbsp; {{btnTxt}}
    </button>
</template>

<script>
    export default{
        props: {
            model: {
                type: String,
                required: true
            },
            modelId: {
                type: Number,
                required: true
            },
            itemName: String,
            redirect: String,
            btnTxt: {
                type: String,
                default: 'Delete'
            }
        },

        methods: {
            deleteItem: function () {
                var self = this;

                var path = '/' + self.model + '/' + self.modelId;
                var name = self.itemName ? self.itemName : null;
                var redirectPath = self.redirect ? self.redirect : null;

                confirmDelete.swalConfirmDelete(path, name, redirectPath);
            }
        }
    }
</script>