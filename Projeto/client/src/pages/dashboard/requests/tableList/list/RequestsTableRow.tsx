import { useState } from 'react';
// @mui
import { useTheme } from '@mui/material/styles';
import { Checkbox, TableRow, TableCell, Typography, Stack, Link, MenuItem } from '@mui/material';
// utils
import { fDate } from '../../../../../utils/formatTime';
import createAvatar from '../../../../../utils/createAvatar';
import { fCurrency } from '../../../../../utils/formatNumber';
// components
import Label from '../../../../../components/Label';
import Avatar from '../../../../../components/Avatar';
import Iconify from '../../../../../components/Iconify';
import { TableMoreMenu } from '../../../../../components/table';

// ----------------------------------------------------------------------

interface transactionProps {
  created_at: string;
  id: string;
  title: string;
  value: string;
  description: string;
  category: string;
  avatarUrl: string;
}

type Props = {
  row: transactionProps;
  selected: boolean;
  onSelectRow: VoidFunction;
  onViewRow: VoidFunction;
  onEditRow: VoidFunction;
  onDeleteRow: VoidFunction;
};

export default function RequestsTableRow({
  row,
  selected,
  onSelectRow,
  onViewRow,
  onEditRow,
  onDeleteRow,
}: Props) {
  const theme = useTheme();

  const { category, title, value, created_at, description } = row;

  const [openMenu, setOpenMenuActions] = useState<HTMLElement | null>(null);

  const handleOpenMenu = (event: React.MouseEvent<HTMLElement>) => {
    setOpenMenuActions(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setOpenMenuActions(null);
  };

  return (
    <TableRow hover selected={selected}>
      <TableCell align="left">{title}</TableCell>

      <TableCell align="left">{fCurrency(value)}</TableCell>

      <TableCell align="left">{category}</TableCell>

      <TableCell align="left">{description}</TableCell>

      <TableCell align="left">{fDate(created_at)}</TableCell>

      <TableCell align="right">
        <TableMoreMenu
          open={openMenu}
          onOpen={handleOpenMenu}
          onClose={handleCloseMenu}
          actions={
            <>
              <MenuItem
                onClick={() => {
                  onDeleteRow();
                  handleCloseMenu();
                }}
                sx={{ color: 'error.main' }}
              >
                <Iconify icon={'eva:trash-2-outline'} />
                Delete
              </MenuItem>

              <MenuItem
                onClick={() => {
                  onEditRow();
                  handleCloseMenu();
                }}
              >
                <Iconify icon={'eva:edit-fill'} />
                Edit
              </MenuItem>
            </>
          }
        />
      </TableCell>
    </TableRow>
  );
}
