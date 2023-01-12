import API from '.';

/*= ===================== USERS ====================== */
export const register = async (newUser: object) =>
  API.post(`/users/signup`, newUser);
export const login = async ({
  email,
  password,
}: {
  email: string;
  password: string;
}) => API.post(`/auth/login`, { email, password });
