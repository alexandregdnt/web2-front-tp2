import React, { useState } from 'react';
import EmailLogin from '../components/Auth/EmailLogin/EmailLogin';

function Auth() {
  const [isSignUp, setIsSignUp] = useState(false);
  const switchAuthModeHandler = (): void => setIsSignUp(!isSignUp);

  return (
    <div className="App">
      <h1>React App</h1>
      <EmailLogin switchAuthModeHandler={switchAuthModeHandler} />
    </div>
  );
}

export default Auth;
