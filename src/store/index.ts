import { createReduxStore, register } from '@wordpress/data';

import { reducer } from './reducer';
import { actions } from './actions';
import { selectors } from './selectors';

export const store = createReduxStore( 'sql-to-cpt', {
	reducer,
	actions,
	selectors,
} );

register( store );
