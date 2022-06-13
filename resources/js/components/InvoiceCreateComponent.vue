<template>
    <div>
        <b-button size="sm" variant="primary" @click="showModal"> Criar Fatura </b-button>

        <b-modal ref="my-modal" hide-footer title="Using Component Methods">
        </b-modal>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods: {
      showModal() {
        this.$refs['my-modal'].show()
      },
      hideModal() {
        this.$refs['my-modal'].hide()
      },
      deleteInvoice(){

      },
      editInvoice(){

      }
    }
};
</script>

<style>
</style>