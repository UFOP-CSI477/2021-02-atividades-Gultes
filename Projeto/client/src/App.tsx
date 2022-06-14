// routes
import Router from './routes';
// theme
import ThemeProvider from './theme';
// components
import ThemeSettings from './components/settings';
import ScrollToTop from './components/ScrollToTop';
import NotistackProvider from './components/NotistackProvider';
import useSettings from './hooks/useSettings';
import { useEffect } from 'react';

// ----------------------------------------------------------------------

export default function App() {
  const { onChangeMode, onChangeLayout } = useSettings();

  useEffect(() => {
    onChangeMode('light');
    onChangeLayout('vertical');
  }, []);

  return (
    <ThemeProvider>
      <NotistackProvider>
        <ScrollToTop />
        <Router />
      </NotistackProvider>
    </ThemeProvider>
  );
}
