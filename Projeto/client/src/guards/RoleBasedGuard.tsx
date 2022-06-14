import { m } from 'framer-motion';
// @mui
import { Container, Typography } from '@mui/material';
// hooks
import useAuth from '../hooks/useAuth';
// components

// ----------------------------------------------------------------------

type RoleBasedGuardProp = {
  hasContent?: boolean;
  roles?: string[];
  children: React.ReactNode;
};

export default function RoleBasedGuard({ hasContent, roles, children }: RoleBasedGuardProp) {
  // Logic here to get current user role
  const { user } = useAuth();

  // const currentRole = 'user';
  const currentRole = user?.role; // admin;

  if (typeof roles !== 'undefined' && !roles.includes(currentRole)) {
    return hasContent ? (
      <Container sx={{ textAlign: 'center' }}>
        <m.div>
          <Typography variant="h3" paragraph>
            Permission Denied
          </Typography>
        </m.div>

        <m.div>
          <Typography sx={{ color: 'text.secondary' }}>
            You do not have permission to access this page
          </Typography>
        </m.div>
      </Container>
    ) : null;
  }

  return <>{children}</>;
}
