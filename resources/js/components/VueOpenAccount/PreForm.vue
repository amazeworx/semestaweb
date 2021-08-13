<template>
  <div>
    <div class="bg-white shadow relative">
      <loading
        :active.sync="isLoading"
        :can-cancel="false"
        :is-full-page="true"
        color="#007BFF"
      />
      <div
        class="flex flex-wrap px-4 py-6 lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full">
          <div class="max-w-md mx-auto mb-8">
            <h3 class="w-full text-xl font-bold mb-4">
              Apakah Anda Warga Negara Indonesia?
            </h3>
            <select
              v-model="wni"
              name="wni"
              @change="onWniChanged"
              class="w-full"
            >
              <option value="">-- Pilih --</option>
              <option value="1">Ya, Saya adalah Warga Negara Indonesia</option>
              <option value="0"
                >Tidak, Saya bukan Warga Negara Indonesia</option
              >
            </select>

            <div
              v-if="$v.wni.$error && !$v.wni.required"
              class="form-validation-error"
            >
              <small>Wajib dipilih.</small>
            </div>
          </div>

          <div v-if="wni == 1" class="max-w-md mx-auto mb-8">
            <h3 class="w-full text-xl font-bold mb-4">
              Apakah Anda memiliki rekening BCA?
            </h3>
            <select
              v-model="has_bca"
              name="has_bca"
              @change="onHasBcaChanged"
              class="w-full"
            >
              <option value="">-- Pilih --</option>
              <option value="1">Ya, Saya memiliki rekening BCA</option>
              <option value="0">Tidak, Saya tidak punya rekening BCA</option>
            </select>

            <div
              v-if="$v.has_bca.$error && !$v.has_bca.required"
              class="form-validation-error"
            >
              <small>Wajib dipilih.</small>
            </div>
          </div>

          <div v-if="wni == 1 && has_bca == 1" class="max-w-md mx-auto mb-8">
            <div class="w-full mb-8">
              <h3 class="w-full text-xl font-bold mb-4">
                Verifikasi rekening BCA Anda
              </h3>
              <div class="w-full mb-2">
                <div class="form-label">
                  Nama Pemilik Rekening
                  <span class="form-required">*</span>
                </div>
                <input
                  type="text"
                  v-model="bca_account_name"
                  name="bca_account_name"
                  @change="$v.bca_account_name.$touch()"
                  placeholder="Isi nama rekening BCA Anda"
                />
                <div
                  v-if="
                    $v.bca_account_name.$error && !$v.bca_account_name.required
                  "
                  class="form-validation-error"
                >
                  <small>Nama Pemilik Rekening wajib diisi.</small>
                </div>
              </div>
              <div class="w-full">
                <div class="form-label">
                  Nomor Rekening
                  <span class="form-required">*</span>
                </div>
                <input
                  type="text"
                  v-model="bca_account_number"
                  name="bca_account_number"
                  @change="$v.bca_account_number.$touch()"
                  placeholder="Isi nomor rekening BCA Anda"
                />
                <div
                  v-if="
                    $v.bca_account_number.$error &&
                      !$v.bca_account_number.required
                  "
                  class="form-validation-error"
                >
                  <small>Nomor Rekening wajib diisi.</small>
                </div>
              </div>
              <div
                v-if="validated_bca_message !== null"
                class="form-validation-error"
              >
                <small>{{ validated_bca_message }}</small>
              </div>
            </div>
          </div>

          <div class="max-w-md mx-auto mb-8">
            <div class="w-full mb-8">
              <div class="form-label">
                Email <span class="form-required">*</span>
              </div>
              <input
                type="text"
                name="email"
                placeholder="Isi alamat email Anda"
                v-model="email"
                @change="$v.email.$touch()"
              />
              <div
                v-if="$v.email.$error && !$v.email.required"
                class="form-validation-error"
              >
                <small>Email wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <vue-recaptcha
                sitekey="6LdDQNUbAAAAAEPjmfHb-d0HEvHSwxaVUSWTXkdd"
                :loadRecaptchaScript="true"
                ref="recaptcha"
                @verify="onCaptchaVerified"
                @expired="onCaptchaExpired"
              ></vue-recaptcha>
              <div
                v-if="validated_captcha_message != null"
                class="form-validation-error"
              >
                <small>{{ validated_captcha_message }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Buttons -->
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigateNext()"
        type="button"
        class="
          px-4
          py-2
          border
          rounded
          text-sm
          font-bold
          uppercase
          bg-orange
          border-orange
          text-white
          hover:bg-orange-light
          hover:border-orange-light
          focus:outline-none
          transition
          ease-in-out
          duration-150
        "
      >
        Berikutnya ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { required, requiredIf } from "vuelidate/lib/validators";
import { mutateFields } from "../../helpers/helpers.js";
import { sha256 } from "js-sha256";
import VueRecaptcha from "vue-recaptcha";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: { VueRecaptcha, Loading },
  data() {
    return {
      isLoading: false,
      validated_bca: false,
      validated_bca_message: null,
      access_token: null,
      recaptcha: "",
      validated_captcha: false,
      validated_captcha_message: null
    };
  },
  mounted() {
    window.onbeforeunload = function() {
      localStorage.removeItem("open-account");
    };
    this.$store.commit("SET_STEP", "0");
  },
  computed: {
    ...mutateFields({
      fields: [
        "wni",
        "has_bca",
        "bca_account_number",
        "bca_account_name",
        "bank_2_name",
        "bank_2_accnumber",
        "bank_2_accname",
        "email",
        "lead_id",
        "account_id"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    })
  },
  validations: {
    wni: {
      required
    },
    has_bca: {
      required: requiredIf(function() {
        return this.wni == "1";
      })
    },
    bca_account_number: {
      required: requiredIf(function() {
        return this.has_bca == "1";
      })
    },
    bca_account_name: {
      required: requiredIf(function() {
        return this.has_bca == "1";
      })
    },
    email: {
      required
    }
  },
  methods: {
    onWniChanged: function() {
      this.has_bca = "";
      this.bca_account_name = "";
      this.bca_account_number = "";
      this.bank_2_name = "";
      this.bank_2_accname = "";
      this.bank_2_accnumber = "";
      this.email = "";
    },
    onHasBcaChanged: function() {
      this.bca_account_name = "";
      this.bca_account_number = "";
      this.bank_2_name = "";
      this.bank_2_accname = "";
      this.bank_2_accnumber = "";
      this.email = "";
    },
    onCaptchaVerified: function(recaptchaToken) {
      this.recaptcha = recaptchaToken;
      this.validated_captcha = true;
      this.validated_captcha_message = null;
    },
    onCaptchaExpired: function() {
      this.$refs.recaptcha.reset();
      this.validated_captcha = false;
    },
    async validateBCA() {
      const data = qs.stringify({
        grant_type: "client_credentials"
      });
      const config = {
        method: "post",
        url: "https://devapi.klikbca.com/api/oauth/token",
        headers: {
          Authorization:
            "Basic YjY2OTI1ZGUtZDhlYy00NzZlLWExNzAtNmNmMDZjODYzYjc4OmVmYzcxY2VkLWIwZTctNGI0Ny04MjcwLTNjMjQ4Mjk3NjRhYQ==",
          "Content-Type": "application/x-www-form-urlencoded"
        },
        data: data
      };
      await axios(config)
        .then(response => {
          this.access_token = response.data.access_token;
          //console.log(this.access_token);
        })
        .catch(function(error) {
          //console.log(error);
        });
    },
    async getValidationBCA(token, account_name, account_number) {
      const access_token = token;
      const apiKey = "34bec438-9911-494c-9e29-d0041f941eec";
      const apiSecret = "f6068d37-0fd8-456a-bced-61ac35af53da";
      const accountName = account_name;
      const accountNumber = account_number;
      const date = new Date();
      const timestamp = date.toISOString();
      const requestBody =
        "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
      const httpMethod = "GET";
      const baseUrl = "https://devapi.klikbca.com";
      const relativeUrl =
        "/banking/general/corporates/h2hauto009/accounts/" +
        accountNumber +
        "/validation?Action=validate&By=name&Value=" +
        accountName;
      let examineUri = baseUrl;
      examineUri += relativeUrl;
      const stringToSign =
        httpMethod +
        ":" +
        relativeUrl +
        ":" +
        access_token +
        ":" +
        requestBody +
        ":" +
        timestamp;
      const signature = sha256.hmac(apiSecret, stringToSign);
      const config = {
        method: "get",
        url: examineUri,
        headers: {
          Authorization: "Bearer " + access_token,
          "Content-Type": "application/json",
          "X-BCA-Key": apiKey,
          "X-BCA-Timestamp": timestamp,
          "X-BCA-Signature": signature
        },
        data: ""
      };
      await axios(config)
        .then(response => {
          if (response.status === 200) {
            this.validated_bca = true;
            this.validated_bca_message = null;
          }
        })
        .catch(error => {
          this.validated_bca_message =
            error.response.data.ErrorMessage.Indonesian;
        });
    },
    async navigateNext() {
      // console.log("WNI: ", this.wni);
      // console.log("Has BCA: ", this.has_bca);
      // console.log("Email: ", this.email);
      // console.log("BCA Acc Name: ", this.bca_account_name);
      // console.log("BCA Acc Number: ", this.bca_account_number);
      // console.log("Captcha: ", this.validated_captcha);

      this.$v.$touch();
      if (this.$v.$error) return;
      this.isLoading = true;
      if (!this.validated_captcha) {
        //console.log("Captcha Error");
        this.isLoading = false;
        this.validated_captcha_message = "Captcha wajib diisi.";
        return;
      } else {
        //console.log("Captcha Passed");
        this.validated_captcha_message = null;
      }

      if (this.bca_account_name && this.bca_account_number) {
        // Validate BCA
        await this.validateBCA().then(response => {
          //console.log(this.access_token);
          const access_token = this.access_token;
          const bca_account_name = encodeURI(this.bca_account_name);
          const bca_account_number = this.bca_account_number;
          this.getValidationBCA(
            access_token,
            bca_account_name,
            bca_account_number
          )
            .then(response => {
              //console.log(this.validated_bca);
              if (this.validated_bca) {
                //this.storeData();
                //this.$router.push("/step-1/");
                this.createLead().then(() => {
                  this.requestOtp();
                });
              } else {
                this.isLoading = false;
              }
            })
            .catch(error => {
              console.log(error);
              this.isLoading = false;
            });
        });
      } else {
        this.createLead().then(() => {
          this.requestOtp();
        });
      }
    },
    async requestOtp() {
      const requestOtpPayload = {
        email: this.email,
        lead_id: this.lead_id
      };
      await this.$store
        .dispatch("requestOtp", requestOtpPayload)
        .then(response => {
          //console.log(response);
          this.isLoading = false;
          //this.otp_unique_id = response.uniqueId;
          this.$store.commit("SET_OTP_SENT", true);
          this.$store.commit("SET_OTP_UID", response.uniqueId);
          //console.log(this.otp_unique_id);
          this.$router.push("/otp/");
        });
    },
    async createAccount() {
      this.bank_2_name = "BANK CENTRAL ASIA";
      this.bank_2_accname = this.bca_account_name;
      this.bank_2_accnumber = this.bank_2_accnumber;
      const createDraftPayload = {
        has_bca: this.has_bca,
        bca_account_number: this.bca_account_number,
        bca_account_name: this.bca_account_name,
        bank_2_name: this.bank_2_name,
        bank_2_accname: this.bank_2_accname,
        bank_2_accnumber: this.bank_2_accnumber,
        email: this.email,
        lead_id: this.lead_id
      };
      await this.$store
        .dispatch("createDraftAccount", createDraftPayload)
        .then(response => {
          //console.log(response);
          this.isLoading = false;
          this.account_id = response.id;
        });
    },
    async createLead() {
      const createLeadPayload = {
        wni: this.wni,
        has_bca: this.has_bca,
        email: this.email
      };
      await this.$store
        .dispatch("createLead", createLeadPayload)
        .then(response => {
          this.lead_id = response.id;
        });
    },
    async storeData() {
      const createLeadPayload = {
        wni: this.wni,
        has_bca: this.has_bca,
        email: this.email
      };
      await this.$store
        .dispatch("createLead", createLeadPayload)
        .then(response => {
          this.lead_id = response.id;
          if (response.status == "exist") {
            if (response.account_status == "complete") {
              this.createAccount();
            } else {
              this.account_id = response.account_id;
            }
            this.requestOtp();
            return;
          } else {
            this.createAccount();
            this.requestOtp();
          }
        });
    }
  }
};
</script>
