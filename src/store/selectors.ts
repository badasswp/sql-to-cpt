import type { SQLState } from './types';

export const selectors = {
	isLoading( state: SQLState ) {
		return state.isLoading;
	},

	getSqlNotice( state: SQLState ) {
		return state.sqlNotice;
	},

	getParsedSQL( state: SQLState ) {
		return state.parsedSQL;
	},
};
