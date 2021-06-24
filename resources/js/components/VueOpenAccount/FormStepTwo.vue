<template>
  <div>
    <div class="bg-white shadow">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Pekerjaan</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Pekerjaan <span class="form-required">*</span>
              </div>
              <select
                v-model="occupation_id_bca"
                name="occupation_id_bca"
                @change="setOccupation($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option
                  v-for="option in occupation_options"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
              <div v-show="occupationIsOther" class="mt-2">
                <input
                  type="text"
                  v-model="occupation_text"
                  @change="$v.occupation_text.$touch()"
                  name="occupation_text"
                  placeholder="Isi Pekerjaan Anda"
                />
              </div>
              <div
                v-if="
                  ($v.occupation_id_bca.$error &&
                    !$v.occupation_id_bca.required) ||
                    ($v.occupation_text.$error && !$v.occupation_text.required)
                "
                class="form-validation-error"
              >
                <small>Pekerjaan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Jabatan/Pangkat <span class="form-required">*</span>
              </div>
              <div v-show="!jobPositionIsText">
                <select
                  v-model="job_position"
                  name="job_position"
                  @change="setBusinessField(null, $event.target.value)"
                >
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in position_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="jobPositionIsOther || jobPositionIsText"
                v-bind:class="{ 'mt-2': jobPositionIsOther }"
              >
                <input
                  type="text"
                  v-model="job_position_text"
                  @change="$v.job_position_text.$touch()"
                  name="job_position_text"
                  placeholder="Isi Jabatan/Pangkat Anda"
                />
              </div>
              <div
                v-if="
                  ($v.job_position.$error && !$v.job_position.required) ||
                    ($v.job_position_text.$error &&
                      !$v.job_position_text.required)
                "
                class="form-validation-error"
              >
                <small>Jabatan/Pangkat wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Bidang Usaha <span class="form-required">*</span>
              </div>
              <div v-show="!businessFieldIsText">
                <select v-model="business_field" name="business_field">
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in business_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="businessFieldIsOther || businessFieldIsText"
                v-bind:class="{ 'mt-2': businessFieldIsOther }"
              >
                <input
                  type="text"
                  v-model="business_field_text"
                  @change="$v.business_field_text.$touch()"
                  name="business_field_text"
                  placeholder="Isi Bidang Usaha Pekerjaan Anda"
                />
              </div>
              <div
                v-if="
                  ($v.business_field.$error && !$v.business_field.required) ||
                    ($v.business_field_text.$error &&
                      !$v.business_field_text.required)
                "
                class="form-validation-error"
              >
                <small>Bidang Usaha wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Uploads</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-6">
            <div class="w-full md:w-1/2">
              <label class="form-label"
                >Upload KTP <span class="form-required">*</span></label
              >
              <file-pond
                name="upload_ktp"
                ref="pond"
                label-idle="Drop files here..."
                v-bind:allow-multiple="false"
                accepted-file-types="image/jpeg, image/png"
                server="/api/upload"
                v-bind:files="upload_ktp"
                v-on:init="handleFilePondInit"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigatePrev()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        ⟵ Kembali
      </button>
      <button
        @click="navigateNext()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        Berikutnya ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { mutateFields } from "../../helpers/helpers.js";
import { required, requiredUnless, requiredIf } from "vuelidate/lib/validators";
import vSelect from "vue-select";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);

export default {
  components: { vSelect, FilePond },
  data() {
    return {
      occupation_options: [],
      position_options: [],
      business_options: [],
      upload_ktp: ""
    };
  },
  mounted() {
    axios.get("/api/occupation").then(response => {
      this.occupation_options = response.data;
    });
    if (this.occupation_id_bca) {
      axios.get("/api/position/" + this.occupation_id_bca).then(response => {
        let jobPositions = response.data;
        this.position_options = jobPositions;
      });
    }
    if (this.occupation_id_bca && this.job_position) {
      axios
        .get(
          "/api/business/" + this.occupation_id_bca + "/" + this.job_position
        )
        .then(response => {
          let businessFields = response.data;
          this.business_options = businessFields;
        });
    }
  },
  computed: {
    ...mutateFields({
      fields: [
        "occupation_id_bca",
        "occupation_id_ksei",
        "occupation_name",
        "occupation_text",
        "job_position",
        "job_position_text",
        "business_field",
        "business_field_text"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    occupationIsOther() {
      if (this.$store.getters.fields.occupation_id_bca === 18) return true;
      return false;
    },
    jobPositionIsOther() {
      if (this.$store.getters.fields.job_position === 99) return true;
      return false;
    },
    jobPositionIsText() {
      if (this.$store.getters.fields.occupation_id_bca === 3) return true;
      return false;
    },
    businessFieldIsOther() {
      if (this.$store.getters.fields.business_field === 99) return true;
      return false;
    },
    businessFieldIsText() {
      if (this.$store.getters.fields.occupation_id_bca === 3) return true;
      return false;
    }
  },
  validations: {
    occupation_id_bca: {
      required
    },
    occupation_text: {
      required: requiredIf("occupationIsOther")
    },
    job_position: {
      required: requiredUnless("jobPositionIsText")
    },
    job_position_text: {
      required: requiredIf(function() {
        return this.jobPositionIsOther || this.jobPositionIsText;
      })
    },
    business_field: {
      required: requiredUnless("businessFieldIsText")
    },
    business_field_text: {
      required: requiredIf(function() {
        return this.businessFieldIsOther || this.businessFieldIsText;
      })
    }
  },
  methods: {
    setOccupation(e) {
      this.occupation_id_bca = "";
      this.occupation_id_ksei = "";
      this.occupation_name = "";
      this.occupation_text = "";

      let occupation_id = e.target.value;

      // Set selected occupation data
      axios.get("/api/occupation/" + occupation_id).then(response => {
        let occupation = response.data;
        this.occupation_id_bca = occupation[0].id;
        this.occupation_id_ksei = occupation[0].ksei_code;
        this.occupation_name = occupation[0].name;
      });

      this.setJobPosition(occupation_id);
    },
    setJobPosition(occupation_id) {
      this.position_options = [];
      this.job_position = "";
      this.job_position_text = "";
      this.business_options = [];
      this.business_field = "";
      this.business_field_text = "";

      // Set job positions options
      axios.get("/api/position/" + occupation_id).then(response => {
        let jobPositions = response.data;
        this.position_options = jobPositions;
        let countPositions = Object.keys(jobPositions).length;
        if (countPositions === 1) {
          this.job_position = jobPositions[0].id;
          let position_id = jobPositions[0].id;
          this.setBusinessField(occupation_id, position_id);
        }
      });
    },
    setBusinessField(occupation_id, position_id) {
      this.business_options = [];
      this.business_field = "";
      this.business_field_text = "";

      if (occupation_id == null) {
        occupation_id = this.occupation_id_bca;
      }

      axios
        .get("/api/business/" + occupation_id + "/" + position_id)
        .then(response => {
          let businessFields = response.data;
          this.business_options = businessFields;
          let countBusiness = Object.keys(businessFields).length;
          if (countBusiness === 1) {
            this.business_field = businessFields[0].id;
          }
        });
    },
    handleFilePondInit: function() {
      console.log("FilePond has initialized");
      // FilePond instance methods are available on `this.$refs.pond`
      this.$refs.pond.getFiles();
    },
    navigatePrev() {
      this.$router.push("/first-step/");
    },
    navigateNext() {
      this.$v.$touch();
      if (this.$v.$error) return;
      //console.log(this.$store.getters.fields);
      this.$store.dispatch("createPost", this.$store.getters.fields);
      //this.$router.push("/second-step/");
      console.log("Ok");
    }
  }
};
</script>
