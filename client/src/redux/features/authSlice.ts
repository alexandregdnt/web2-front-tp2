import { createSlice } from '@reduxjs/toolkit';

export const authSlice = createSlice({
  name: 'auth',
  initialState: {
    auth: null,
  },
  reducers: {
    authSuccess: (state, { payload }) => {
      localStorage.setItem('profile', JSON.stringify(payload));
      // eslint-disable-next-line
      state.auth = payload;
    },
    // register: (state, { payload }) => {},
    register: () => {},
    login: (state, { payload }) => {
      localStorage.setItem('profile', JSON.stringify(payload));
      // eslint-disable-next-line
      state.auth = payload;
    },
    logout: (state) => {
      localStorage.clear();
      sessionStorage.clear(); // Microsoft Logout
      // eslint-disable-next-line
      state.auth = null;
    },
  },
});

export const { authSuccess, register, login, logout } = authSlice.actions;
export default authSlice.reducer;
