// @mui
import { Stack, Typography, CircularProgress } from '@mui/material';
// components
import Iconify from '../../../components/Iconify';

// ----------------------------------------------------------------------

type Props = {
  icon: string;
  title: string;
  total?: number;
  percent?: number;
  quantity: number;
  color?: string;
};

export default function RequestsAnalytic({ title, icon, color, quantity }: Props) {
  return (
    <Stack
      direction="row"
      alignItems="center"
      justifyContent="center"
      sx={{ width: 1, minWidth: 200 }}
    >
      <Stack spacing={0.5} sx={{ ml: 2 }} justifyContent="center" alignItems="center">
        <Typography variant="h6">{title}</Typography>

        <Typography variant="subtitle2" sx={{ color }}>
          {quantity}
        </Typography>
      </Stack>
    </Stack>
  );
}
