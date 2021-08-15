const getters = {
  fields: (state) => state.fields,
  step: (state) => state.step,
  step_validated: (state) => state.step_validated,
  db_loaded: (state) => state.db_loaded,
  otp_sent: (state) => state.otp_sent,
  otp_unique_id: (state) => state.otp_unique_id,
  otp_resend_id: (state) => state.otp_resend_id,
}

export default getters