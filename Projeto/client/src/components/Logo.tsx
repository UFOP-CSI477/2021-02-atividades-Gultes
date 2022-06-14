import { Link as RouterLink } from 'react-router-dom';
// @mui
import { useTheme } from '@mui/material/styles';
import { Box, BoxProps } from '@mui/material';
import Image from './Image';
// ----------------------------------------------------------------------

interface Props extends BoxProps {
  disabledLink?: boolean;
  height?: number | string;
  width?: number | string;
}

export default function Logo({ disabledLink = false, height, width }: Props) {
  const theme = useTheme();

  // OR
  // const logo = '/logo/logo_single.svg';

  const logo = (
    <Image
      visibleByDefault
      disabledEffect
      src="/images/logo.png"
      alt="logo"
      sx={{ width: width ? width : '180px', height: height ? height : '180px' }}
    />
  );

  if (disabledLink) {
    return <>{logo}</>;
  }

  return <RouterLink to="/">{logo}</RouterLink>;
}
