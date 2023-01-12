import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { Form, Formik } from 'formik';
import * as Yup from 'yup';

import { login } from '../../../redux/features/authSlice';
import * as api from '../../../api/authAPI';

import Alert, { AlertProps } from '../../Common/Alert/Alert';
import TextField from '../../Common/Form/TextField/TextField';

import './EmailLogin.css';

function EmailLogin({ switchAuthModeHandler }: EmailLoginProps) {
  const dispatch = useDispatch();
  const userData = useSelector((state: any) => state.auth.account);
  const [alert, setAlert] = useState({
    msg: null,
    type: null,
  } as unknown as AlertProps);
  const navigate = useNavigate();

  const validate = Yup.object({
    email: Yup.string().email('Invalid email').required('Required'),
    password: Yup.string().required('Required'),
  });

  useEffect(() => {
    if (userData) navigate('/menu');
  });

  const handleSubmit = async (values: any) => {
    console.log(values);

    try {
      api
        .login(values)
        .then((res) => {
          dispatch(login(res.data));
          navigate('/menu');
        })
        .catch((e) => {
          // console.log(e.response.data?.message);
          return setAlert({ msg: e.response.data?.message, type: 'error' });
        });
    } catch (e) {
      console.log(e);
    }
  };

  return (
    <div className="auth__container container">
      {alert.msg ? <Alert type={alert.type} msg={alert.msg} /> : ''}

      <h2 className="section__title">Login</h2>
      <span className="section__subtitle">Fill required form fields</span>

      <div>
        <Formik
          initialValues={{
            email: '',
            password: '',
          }}
          validationSchema={validate}
          onSubmit={(values) => handleSubmit(values)}
        >
          {() => (
            <div>
              <Form className="auth__form grid">
                <TextField
                  label="Email"
                  name="email"
                  type="email"
                  required
                  autoFocus
                />
                <TextField
                  label="Password"
                  name="password"
                  type="password"
                  required
                />

                <div className="auth__button-container">
                  <button className="button" type="submit">
                    Sign In
                  </button>
                </div>
              </Form>
            </div>
          )}
        </Formik>

        <div className="auth__switch">
          <div className="auth__switch-button" onClick={switchAuthModeHandler}>
            <Link to="/auth/email/register">
              You don't have an account? <span>Sign Up</span>
            </Link>
          </div>
          <div className="auth__switch-button">
            <Link to="/auth">Go Back</Link>
          </div>
        </div>
      </div>
    </div>
  );
}

interface EmailLoginProps {
  switchAuthModeHandler: () => void;
}

export default EmailLogin;
