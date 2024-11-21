<template>
  <b-tr>
    <b-td class="text-bold">
      4. Jumlah Pengguna Hak Pilih (B.1 + B.2 + B.3)
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_pengguna_l[id]" type="number" readonly></b-form-input>
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_pengguna_p[id]" type="number" readonly></b-form-input>
    </b-td>
    <b-td style="vertical-align: top;" class="text-center">
      <b-form-input v-model="form.pengguna_hak_pilih.jml_pengguna[id]" type="number" readonly></b-form-input>
    </b-td>
  </b-tr>
</template>

<script>
import { BTr, BTd, BFormInput } from 'bootstrap-vue'
export default {
  components: {
    BTr, BTd, BFormInput
  },
  props: {
    form: {
      type: Object,
      required: true
    },
    id: {
      type: Number,
      required: true
    },
  },
}
</script>