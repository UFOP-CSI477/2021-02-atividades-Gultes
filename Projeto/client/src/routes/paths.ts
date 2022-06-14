// ----------------------------------------------------------------------

function path(root: string, sublink: string) {
  return `${root}${sublink}`;
}

const ROOTS_AUTH = '/auth';
const ROOTS_DASHBOARD = '/dashboard';

// ----------------------------------------------------------------------

export const PATH_AUTH = {
  root: ROOTS_AUTH,
  login: path(ROOTS_AUTH, '/login'),
  register: path(ROOTS_AUTH, '/register'),
};

export const PATH_DASHBOARD = {
  root: ROOTS_DASHBOARD,
  requests: {
    list: path(ROOTS_DASHBOARD, '/requests/list'),
    new: path(ROOTS_DASHBOARD, '/requests/new'),
    edit: (id: string) => path(ROOTS_DASHBOARD, `/requests/${id}/edit`),
    view: (id: string) => path(ROOTS_DASHBOARD, `/requests/${id}`),
  },
};
