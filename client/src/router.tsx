import { createBrowserRouter } from 'react-router-dom';
import Root from './layouts/Root';
import ErrorPage from './layouts/ErrorPage';

import Contact from './routes/Contact';

const router = createBrowserRouter([
  {
    path: '/',
    element: <Root />,
    errorElement: <ErrorPage />,
    children: [
      {
        path: 'dashboard',
        element: <Contact />,
      },
    ],
  },
]);

export default router;
