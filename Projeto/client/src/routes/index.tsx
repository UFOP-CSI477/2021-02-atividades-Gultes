import { Suspense, lazy, ElementType } from 'react';
import { Navigate, useRoutes, useLocation } from 'react-router-dom';
// hooks
import useAuth from '../hooks/useAuth';
// layouts

import DashboardLayout from '../layouts/dashboard';
import LogoOnlyLayout from '../layouts/LogoOnlyLayout';
// guards
import GuestGuard from '../guards/GuestGuard';
import AuthGuard from '../guards/AuthGuard';
// import RoleBasedGuard from '../guards/RoleBasedGuard';
// config
import { PATH_AFTER_LOGIN } from '../config';
// components
import LoadingScreen from '../components/LoadingScreen';

// ----------------------------------------------------------------------

const Loadable = (Component: ElementType) => (props: any) => {
  // eslint-disable-next-line react-hooks/rules-of-hooks
  const { pathname } = useLocation();

  // eslint-disable-next-line react-hooks/rules-of-hooks
  const { isAuthenticated } = useAuth();

  const isDashboard = pathname.includes('/dashboard') && isAuthenticated;

  return (
    <Suspense fallback={<LoadingScreen isDashboard={isDashboard} />}>
      <Component {...props} />
    </Suspense>
  );
};

export default function Router() {
  return useRoutes([
    {
      path: 'auth',
      children: [
        {
          path: 'login',
          element: (
            <GuestGuard>
              <Login />
            </GuestGuard>
          ),
        },
        {
          path: 'register',
          element: (
            <GuestGuard>
              <Register />
            </GuestGuard>
          ),
        },
        { path: 'login-unprotected', element: <Login /> },
        { path: 'register-unprotected', element: <Register /> },
      ],
    },

    // Dashboard Routes
    {
      path: 'dashboard',
      element: (
        <AuthGuard>
          <DashboardLayout />
        </AuthGuard>
      ),
      children: [
        { element: <Navigate to={PATH_AFTER_LOGIN} replace />, index: true },
        // { path: 'app', element: <GeneralApp /> },
        // { path: 'requests', element: <Requests /> },

        {
          path: 'requests',
          children: [
            { element: <Navigate to="/dashboard/requests" replace />, index: true },
            { path: 'list', element: <RequestsList /> },
            { path: 'new', element: <RequestsCreate /> },
            { path: ':id/edit', element: <RequestsCreate /> },
          ],
        },
      ],
    },

    // Main Routes
    {
      path: '*',
      children: [
        { path: '404', element: <Page404 /> },
        { path: '*', element: <Navigate to="/404" replace /> },
      ],
    },
    {
      path: '/',
      element: (
        <AuthGuard>
          <DashboardLayout />
        </AuthGuard>
      ),
      children: [{ element: <Navigate to={PATH_AFTER_LOGIN} replace />, index: true }],
    },
    { path: '*', element: <Navigate to="/404" replace /> },
  ]);
}

// AUTHENTICATION
const Login = Loadable(lazy(() => import('../pages/auth/Login')));
const Register = Loadable(lazy(() => import('../pages/auth/Register')));

const Page404 = Loadable(lazy(() => import('../pages/Page404')));

// REQUESTS
const RequestsList = Loadable(
  lazy(() => import('../pages/dashboard/requests/tableList/RequestList'))
);
const RequestsCreate = Loadable(
  lazy(() => import('../pages/dashboard/requests/createEdit/RequestsCreate'))
);
