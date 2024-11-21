<template>
  <b-tr>
    <b-td>
      3. Pengguna hak pilih dalam Daftar Pemilih Tetap Tambahan (DPTK)
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_kl[id]" type="number" :state="state.pengguna_hak_pilih.dpt_kl[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_kl[id]">{{ feedback.pengguna_hak_pilih.dpt_kl[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.dpt_kp[id]" type="number" :state="state.pengguna_hak_pilih.dpt_kp[id]"
        @input="jmlDpt(id)"></b-form-input>
      <b-form-invalid-feedback :state="state.pengguna_hak_pilih.dpt_kp[id]">{{ feedback.pengguna_hak_pilih.dpt_kp[id] }}</b-form-invalid-feedback>
    </b-td>
    <b-td style="vertical-align: top;" class="text-center">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_dptk[id]" type="number" readonly></b-form-input>
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
        sum: parseInt(this.form.pengguna_hak_pilih.dpt_kl[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_kp[id]),
      })
    }
  }
}
</script>