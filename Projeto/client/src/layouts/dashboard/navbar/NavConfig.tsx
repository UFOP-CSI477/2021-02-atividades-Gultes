// routes
import { PATH_DASHBOARD } from '../../../routes/paths';
// components

import SvgIconStyle from '../../../components/SvgIconStyle';

// ----------------------------------------------------------------------

const getIcon = (name: string) => (
  <SvgIconStyle src={`/assets/icons/navbar/${name}.svg`} sx={{ width: 1, height: 1 }} />
);

const ICONS = {
  banking: getIcon('ic_banking'),
};

const navConfig = [
  {
    subheader: 'general',
    items: [
      {
        title: 'Controle financeiro',
        path: PATH_DASHBOARD.requests.list,
        icon: ICONS.banking,
      },
    ],
  },
];

export default navConfig;
