import React from 'react';
import { UilTimes } from '@iconscout/react-unicons';

function Alert({ type = 'error', msg }: AlertProps) {
  if (!msg) return null;

  return (
    <div className={`alert ${type}`}>
      <UilTimes className="alert__close" />
      <strong>{type} : </strong>
      {msg}
    </div>
  );
}

export interface AlertProps {
  type?: 'error' | 'success' | 'warning' | 'info';
  msg: string;
}

export default Alert;
