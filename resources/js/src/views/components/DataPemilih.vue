<template>
  <b-tr>
    <b-td>
      Jumlan Pemilih dalam Daftar Pemilih Tetap (DPT)<br>
      (terdapat dalam Model A-KabKo Daftar Pemilih)
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.data_pemilih.dpt_l[id]" type="number" readonly :state="state.data_pemilih.dpt_l[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.data_pemilih.dpt_l[id]">{{ feedback.data_pemilih.dpt_l[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.data_pemilih.dpt_p[id]" type="number" readonly :state="state.data_pemilih.dpt_p[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.data_pemilih.dpt_p[id]">{{ feedback.data_pemilih.dpt_p[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;" class="text-center">
      <b-form-input v-model="form.data_pemilih.jml_dpt[id]" type="number" readonly></b-form-input>
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
        sum: parseInt(this.form.data_pemilih.dpt_l[id]) + parseInt(this.form.data_pemilih.dpt_p[id]),
      })
    }
  }
}
</script>