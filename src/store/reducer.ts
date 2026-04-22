import type { SQLState } from './types';
import { DEFAULT_STATE } from './types';

export const reducer = (
	state: SQLState = DEFAULT_STATE,
	action: any
): SQLState => {
	switch ( action.type ) {
		case 'SET_LOADING':
			return { ...state, isLoading: action.value };

		case 'SET_NOTICE':
			return { ...state, sqlNotice: action.value };

		case 'SET_PARSED_SQL':
			return { ...state, parsedSQL: action.value };

		default:
			return state;
	}
};
