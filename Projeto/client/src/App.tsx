// routes
import Router from './routes';
// theme
import ThemeProvider from './theme';
// components
import ThemeSettings from './components/settings';
import ScrollToTop from './components/ScrollToTop';
import NotistackProvider from './components/NotistackProvider';

// ----------------------------------------------------------------------

export default function App() {
  return (
    <ThemeProvider>
      <ThemeSettings>
        <NotistackProvider>
          <ScrollToTop />
          <Router />
        </NotistackProvider>
      </ThemeSettings>
    </ThemeProvider>
  );
}
