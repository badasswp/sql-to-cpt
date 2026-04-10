import { createReduxStore, register } from '@wordpress/data';

export interface SQLState {
	isLoading: boolean;
	sqlNotice: string;
	parsedSQL: {
		tableName: string;
		tableColumns: string[];
		tableRows: any[];
	};
}

const DEFAULT_STATE: SQLState = {
	isLoading: false,
	sqlNotice: '',
	parsedSQL: {
		tableName: '',
		tableColumns: [],
		tableRows: [],
	},
};

const reducer = ( state: SQLState = DEFAULT_STATE, action: any ): SQLState => {
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

const actions = {
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

const selectors = {
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

export const store = createReduxStore( 'sql-to-cpt', {
	reducer,
	actions,
	selectors,
} );

register( store );
