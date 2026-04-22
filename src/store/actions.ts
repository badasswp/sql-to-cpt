import type { SQLState } from './types';

export const actions = {
	setIsLoading( value: boolean ) {
		return {
			type: 'SET_LOADING',
			value,
		};
	},

	setSqlNotice( value: string ) {
		return {
			type: 'SET_NOTICE',
			value,
		};
	},

	setParsedSQL( value: SQLState[ 'parsedSQL' ] ) {
		return {
			type: 'SET_PARSED_SQL',
			value,
		};
	},
};
