// hooks
import useAuth from '../hooks/useAuth';
// utils
import createAvatar from '../utils/createAvatar';
//
import Avatar, { Props as AvatarProps } from './Avatar';

// ----------------------------------------------------------------------

export default function MyAvatar({ ...other }: AvatarProps) {
  const { user } = useAuth();

  return (
    <Avatar
      src={user?.photo_url}
      alt="Administrador"
      color={user?.photo_url ? 'default' : createAvatar('Administrador').color}
      {...other}
    >
      {createAvatar(user?.name).name}
    </Avatar>
  );
}
