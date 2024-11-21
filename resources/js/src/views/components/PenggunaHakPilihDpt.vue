<template>
  <b-tr>
    <b-td style="vertical-align: top;">
      1. Pengguna hak pilih dalam Daftar Pemilih Tetap (DPT)
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_l[id]" type="number" :state="state.pengguna_hak_pilih.dpt_l[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_l[id]">{{ feedback.pengguna_hak_pilih.dpt_l[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_p[id]" type="number" :state="state.pengguna_hak_pilih.dpt_p[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_p[id]">{{ feedback.pengguna_hak_pilih.dpt_p[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;" class="text-center">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_dpt[id]" type="number" readonly></b-form-input>
    </b-td>
  </b-tr>
</template>

<script>
import { BTr, BTd, BFormInput, BFormInvalidFeedback } from 'bootstrap-vue'
export default {
  components: {
    BTr, BTd, BFormInput, BFormInvalidFeedback
  },
  props: {
    form: {
      type: Object,
      required: true
    },
    state: {
      type: Object,
      required: true
    },
    feedback: {
      type: Object,
      required: true
    },
    id: {
      type: Number,
      required: true
    },
  },
  methods: {
    jmlDpt(id) {
      this.$emit('jml-dpt', {
        id: id,
        sum: parseInt(this.form.pengguna_hak_pilih.dpt_l[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_p[id]),
      })
    }
  }
}
</script>