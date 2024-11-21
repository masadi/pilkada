<template>
  <b-tr>
    <b-td>
      2. Pengguna hak pilih dalam Daftar Pemilih Tetap Pindahan (DPTb)
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_bl[id]" type="number" :state="state.pengguna_hak_pilih.dpt_bl[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_bl[id]">{{ feedback.pengguna_hak_pilih.dpt_bl[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_bp[id]" type="number" :state="state.pengguna_hak_pilih.dpt_bp[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_bp[id]">{{ feedback.pengguna_hak_pilih.dpt_bp[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;" class="text-center">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_dptb[id]" type="number" readonly></b-form-input>
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
        sum: parseInt(this.form.pengguna_hak_pilih.dpt_bl[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_bp[id]),
      })
    }
  }
}
</script>