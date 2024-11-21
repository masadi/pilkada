<template>
  <b-table-simple responsive bordered>
    <b-thead>
      <b-tr>
        <b-th class="text-center" width="55%">URAIAN</b-th>
        <b-th class="text-center" width="15%">LAKI-LAKI (L)</b-th>
        <b-th class="text-center" width="15%">PEREMPUAN (P)</b-th>
        <b-th class="text-center" width="15%">JUMLAH (L+P)</b-th>
      </b-tr>
    </b-thead>
    <b-tbody>
      <b-tr>
        <b-td>
          Jumlan seluruh Pemilih Disabilitas yang menggunakan hak pilih
        </b-td>
        <b-td style="vertical-align: top;">
          <b-form-input v-model="form.disabilitas.dis_l[id]" type="number" @input="jmlDpt(id)"></b-form-input>
        </b-td>
        <b-td style="vertical-align: top;">
          <b-form-input v-model="form.disabilitas.dis_p[id]" type="number" @input="jmlDpt(id)"></b-form-input>
        </b-td>
        <b-td style="vertical-align: top;" class="text-center">
          <b-form-input v-model="form.disabilitas.jml_dpt[id]" type="number" readonly></b-form-input>
        </b-td>
      </b-tr>
    </b-tbody>
  </b-table-simple>
</template>

<script>
import { BTableSimple, BTbody, BThead, BTr, BTd, BTh, BFormInput } from 'bootstrap-vue'
export default {
  components: {
    BTableSimple, BTbody, BThead, BTr, BTd, BTh, BFormInput
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
  methods: {
    jmlDpt(id) {
      this.$emit('jml-dpt', {
        id: id,
        sum: parseInt(this.form.disabilitas.dis_l[id]) + parseInt(this.form.disabilitas.dis_p[id]),
      })
    }
  }
}
</script>