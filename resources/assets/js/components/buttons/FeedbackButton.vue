<template>
    <button :id="buttonId"
            :class="buttonClass"
            :type="buttonType"
            @click.prevent="toggleFeedback"
    >
        <div class="btn-content" :data-wait="waitTxt">
            <i :class="iconClass" v-if="btnIcon"></i><span v-if="btnIcon">&nbsp; </span>{{btnTxt}}
        </div>
        <div class="wait-content">
            <span class="wait-icon glyphicon glyphicon-hourglass animated rotateIn infinite"></span>
            <span class="wait-text animated flash infinite"></span>
        </div>
    </button>
</template>

<script>
    export default{
        props: {
            btnId: {
                type: String,
                required: true
            },
            btnTxt: {
                type: String,
                required: true
            },
            btnType: {
                type: String,
                default: 'normal',
                validator: function (value) {
                    return value == 'normal' || value == 'form';
                }
            },
            btnIcon: String,
            waitTxt: {
                type: String,
                default: 'Working...'
            },
            btnClass: {
                type: String,
                default: 'default'
            }
        },

        computed: {
            buttonId: function () {
                var self = this;
                return self.btnType == 'normal' ? self.btnId : self.btnId + '-submit-button'
            },
            buttonType: function () {
                var self = this;
                return self.btnType == 'normal' ? 'button' : 'submit'
            },
            buttonClass: function () {
                var self = this;
                return ['btn', 'btn-' + self.btnClass];
            },
            iconClass: function () {
                var self = this;
                return self.btnIcon ? ['fa', 'fa-' + self.btnIcon] : [];
            }
        },

        methods: {
            toggleFeedback: function () {
                var self = this;
                buttonFeedback.toggleFeedback($('#' + self.btnId), self.btnType, 'show');
            }
        }
    }
</script>