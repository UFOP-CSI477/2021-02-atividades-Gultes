// @mui
import { styled } from '@mui/material/styles';
import {
  Box,
  Card,
  Stack,
  Alert,
  Link,
  Container,
  Typography,
  useTheme,
  alpha,
} from '@mui/material';
import { Link as RouterLink } from 'react-router-dom';
// hooks
import useAuth from '../../hooks/useAuth';
import useResponsive from '../../hooks/useResponsive';
// components
import Page from '../../components/Page';
import Logo from '../../components/Logo';

// sections
import { LoginForm } from '../../sections/auth/login';
import { PATH_AUTH } from '../../routes/paths';

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

  const smUp = useResponsive('up', 'sm');

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

              <Typography variant="body2" align="center" sx={{ mt: 3 }}>
                <Link variant="subtitle2" component={RouterLink} to={PATH_AUTH.register}>
                  Criar uma conta
                </Link>
              </Typography>
            </Card>
          </ContentStyle>
        </Container>
      </RootStyle>
    </Page>
  );
}
