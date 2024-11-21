<template>
  <b-table-simple responsive bordered>
    <b-thead>
      <b-tr>
        <b-th class="text-center" width="85%">URAIAN</b-th>
        <b-th class="text-center" width="15%">JUMLAH</b-th>
      </b-tr>
    </b-thead>
    <b-tbody>
      <b-tr>
        <b-td>1. Jumlah surat suara yang diterima termasuk cadangan 2,5 % dari DPT di TPS</b-td>
        <b-td>
          <b-form-input v-model="form.penggunaan.jml_surat_suara[id]" type="number" readonly></b-form-input>
        </b-td>
      </b-tr>
      <b-tr>
        <b-td>2.	Jumlah surat suara yang digunakan oleh pemilih</b-td>
        <b-td>
          <b-form-input v-model="form.penggunaan.digunakan[id]" type="number" readonly></b-form-input>
        </b-td>
      </b-tr>
      <b-tr>
        <b-td>3.	Jumlah surat suara dikembalikan oleh pemilih, karena rusak atau keliru coblos</b-td>
        <b-td>
          <b-form-input v-model="form.penggunaan.dikembalikan[id]" type="number" @input="jmlDpt(id)"></b-form-input>
        </b-td>
      </b-tr>
      <b-tr>
        <b-td>4.	Jumlah surat suara yang tidak digunakan/tidak terpakai, termasuk sisa surat cadangan</b-td>
        <b-td>
          <b-form-input v-model="form.penggunaan.tidak_terpakai[id]" type="number" readonly></b-form-input>
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
        sum: this.form.penggunaan.dikembalikan[id],
      })
    }
  }
}
</script>