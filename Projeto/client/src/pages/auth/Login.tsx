// @mui
import { styled } from '@mui/material/styles';
import { Box, Card, Stack, Alert, Container, Typography, useTheme, alpha } from '@mui/material';

// hooks
import useAuth from '../../hooks/useAuth';
import useResponsive from '../../hooks/useResponsive';
// components
import Page from '../../components/Page';
import Logo from '../../components/Logo';

// sections
import { LoginForm } from '../../sections/auth/login';

// ----------------------------------------------------------------------

const RootStyle = styled('div')(({ theme }) => ({
  [theme.breakpoints.up('md')]: {
    display: 'flex',
  },
  background: 'url(/assets/background.png)',
  backgroundSize: 'cover',
  width: '100%',
  borderRadius: 0,
}));

const SectionStyle = styled(Card)(({ theme }) => ({
  background: 'url(/images/image2.png)',
  backgroundSize: 'cover',
  width: '100%',
  borderRadius: 0,
  maxWidth: 680,
}));

const ContentStyle = styled('div')(({ theme }) => ({
  maxWidth: 480,
  margin: 'auto',
  minHeight: '100vh',
  display: 'flex',
  justifyContent: 'center',
  flexDirection: 'column',
  padding: theme.spacing(12, 0),
}));

// ----------------------------------------------------------------------

export default function Login() {
  const { method } = useAuth();

  const mdUp = useResponsive('up', 'md');

  const theme = useTheme();

  return (
    <Page title="Login">
      <RootStyle>
        <Container maxWidth="sm">
          <ContentStyle>
            <Card
              sx={{
                boxShadow: `0 0 1em ${alpha(theme.palette.grey[900], 0.2)}`,
                padding: theme.spacing(3),
              }}
            >
              <Stack direction="row" alignItems="center" sx={{ mb: 5 }}>
                <Box sx={{ flexGrow: 1 }}>
                  <Typography variant="h4" textAlign="center" gutterBottom>
                    Faça login
                  </Typography>
                </Box>
              </Stack>

              <LoginForm />
            </Card>
          </ContentStyle>
        </Container>
      </RootStyle>
    </Page>
  );
}
